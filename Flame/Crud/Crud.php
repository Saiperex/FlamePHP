<?php

declare(strict_types=1);

namespace Flame\Crud;

use PDO;

class Crud 
{
    protected PDO $db; // Conexión a la base de datos

    /**
     * Constructor de la clase.
     *
     * @param PDO $pdo Instancia de conexión a la base de datos PDO.
     */
    public function __construct(PDO $pdo)
    {
        $this->db = $pdo; // Asigna la conexión PDO proporcionada
    }

    /**
     * Inserta un nuevo registro en la tabla especificada.
     *
     * @param array $valores Array asociativo con los valores a insertar (clave => valor).
     * @param string $tabla Nombre de la tabla en la que se insertará el registro.
     * @return array Retorna un array con 'status' (bool) y 'message' (string).
     */
    public function create(array $valores, string $tabla): array
    {
        $check = $this->tablaExiste($tabla);
        if (!$check['status']) {
            return $check;
        }

        try {
            $columnas = implode(", ", array_keys($valores));
            $placeholders = ":" . implode(", :", array_keys($valores));
            $sql = "INSERT INTO `$tabla` ($columnas) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);

            foreach ($valores as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();

            return [
                'status' => true,
                'message' => "Registro insertado correctamente en la tabla '$tabla'."
            ];
        } catch (\PDOException $e) {
            return [
                'status' => false,
                'message' => "Ocurrió un error al insertar en '$tabla'. " . $e->getMessage()
            ];
        }
    }
    /**
     * Lee registros de la tabla especificada, con soporte para condiciones, orden y paginación.
     *
     * @param string $tabla Nombre de la tabla de la que se leerán los registros.
     * @param array|null $condiciones Condiciones WHERE (clave => valor). Usa '%' para LIKE.
     * @param array|null $columnas Columnas a seleccionar. Si es null, se seleccionan todas.
     * @param array|null $orden Orden de resultados (columna => ASC|DESC).
     * @param int|null $limite Límite de registros a devolver.
     * @param int|null $offset Registros a omitir (offset).
     * @return array Retorna un array con 'status' (bool), 'message' (string) y, si hay resultados, 'data' (array).
     */
    public function read(string $tabla, ?array $condiciones = null, ?array $columnas = null, ?array $orden = null, ?int $limite = null, ?int $offset = null): array
    {
        $check = $this->tablaExiste($tabla);
        if (!$check['status']) {
            return $check;
        }

        try {
            $cols = $columnas ? implode(", ", $columnas) : "*";
            $sql = "SELECT $cols FROM `$tabla`";

            if ($condiciones) {
                $clauses = [];
                foreach ($condiciones as $key => $value) {
                    $clauses[] = is_string($value) && strpos($value, '%') !== false
                        ? "$key LIKE :$key"
                        : "$key = :$key";
                }
                $sql .= " WHERE " . implode(" AND ", $clauses);
            }

            if ($orden) {
                $orders = [];
                foreach ($orden as $col => $dir) {
                    $dir = strtoupper($dir) === "DESC" ? "DESC" : "ASC";
                    $orders[] = "$col $dir";
                }
                $sql .= " ORDER BY " . implode(", ", $orders);
            }

            if ($limite !== null) {
                $sql .= " LIMIT :limite";
            }

            if ($offset !== null) {
                $sql .= " OFFSET :offset";
            }

            $stmt = $this->db->prepare($sql);

            if ($condiciones) {
                foreach ($condiciones as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }
            }

            if ($limite !== null) {
                $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);
            }

            if ($offset !== null) {
                $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => true,
                'data' => $result,
                'message' => count($result) ? "Registros obtenidos correctamente." : "No se encontraron registros."
            ];
        } catch (\PDOException $e) {
            return [
                'status' => false,
                'message' => "Error al consultar la tabla '$tabla'. " . $e->getMessage()
            ];
        }
    }
    /**
     * Actualiza registros existentes en la tabla especificada.
     *
     * @param string $tabla Nombre de la tabla donde se realizará la actualización.
     * @param array $valores Nuevos valores (clave => nuevo valor).
     * @param array $condiciones Condiciones WHERE para identificar registros (clave => valor).
     * @return array Retorna un array con 'status' (bool) y 'message' (string).
     */
    public function update(string $tabla, array $valores, array $condiciones): array
    {
        $check = $this->tablaExiste($tabla);
        if (!$check['status']) {
            return $check;
        }

        try {
            $sets = [];
            foreach ($valores as $key => $value) {
                $sets[] = "$key = :$key";
            }

            $wheres = [];
            foreach ($condiciones as $key => $value) {
                $wheres[] = "$key = :where_$key";
            }

            $sql = "UPDATE `$tabla` SET " . implode(", ", $sets) . " WHERE " . implode(" AND ", $wheres);
            $stmt = $this->db->prepare($sql);

            foreach ($valores as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            foreach ($condiciones as $key => $value) {
                $stmt->bindValue(":where_$key", $value);
            }

            $stmt->execute();

            return [
                'status' => true,
                'message' => "Registro(s) actualizado(s) correctamente."
            ];
        } catch (\PDOException $e) {
            return [
                'status' => false,
                'message' => "Error al actualizar registros en la tabla '$tabla'. " . $e->getMessage()
            ];
        }
    }
    /**
     * Elimina registros de la tabla especificada según condiciones dadas.
     *
     * @param string $tabla Nombre de la tabla de la que se eliminarán registros.
     * @param array $condiciones Condiciones WHERE para identificar qué eliminar (clave => valor).
     * @return array Retorna un array con 'status' (bool) y 'message' (string).
     */
    public function delete(string $tabla, array $condiciones): array
    {
        $check = $this->tablaExiste($tabla);
        if (!$check['status']) {
            return $check;
        }

        try {
            $wheres = [];
            foreach ($condiciones as $key => $value) {
                $wheres[] = "$key = :$key";
            }

            $sql = "DELETE FROM `$tabla` WHERE " . implode(" AND ", $wheres);
            $stmt = $this->db->prepare($sql);

            foreach ($condiciones as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();

            return [
                'status' => true,
                'message' => "Registro(s) eliminado(s) correctamente."
            ];
        } catch (\PDOException $e) {
            return [
                'status' => false,
                'message' => "Error al eliminar registros de la tabla '$tabla'. " . $e->getMessage()
            ];
        }
    }
    /**
     * Verifica si una tabla existe en la base de datos.
     *
     * @param string $tabla Nombre de la tabla a verificar.
     * @return array Retorna un array con 'status' (bool) y 'message' (string).
     */
    private function tablaExiste(string $tabla): array
    {
        try {
            $stmt = $this->db->prepare("SHOW TABLES LIKE :tabla");
            $stmt->bindValue(':tabla', $tabla);
            $stmt->execute();

            return $stmt->fetch() !== false ?
            [
                'status' => true,
                'message' => "La tabla '$tabla' existe."
            ] :
            [
                'status' => false,
                'message' => "La tabla '$tabla' no existe."
            ];
        } catch (\PDOException $e) {
            return [
                'status' => false,
                'message' => "Ocurrió un error al verificar la existencia de la tabla '$tabla'. " . $e->getMessage()
            ];
        }
    }

}