<?php

namespace Mir\TruthWhisper\model;

namespace Mir\TruthWhisper\model;

use Mir\TruthWhisper\trait\ModelHelperTrait;

class Model
{
    use ModelHelperTrait;

    private string $path_to_file;
    private array $data;
    public array $keys = [];
    private string $associated_field_name;
    private mixed $associated_field_value;


    public function __construct(string $file_name, array $keys)
    {
        $this->path_to_file = dirname(__DIR__) . "/file_storage/" . $file_name . ".json";
        $this->keys = $keys;
        $this->getJsonData();
    }

    public function __get(string $name): mixed
    {
        $last_element = count($this->data) - 1;
        return $this->data[$last_element][$name] ?? null;
    }

    public function __set(string $name, mixed $value)
    {
        if (!empty($this->data)) {
            $last_element = count($this->data) - 1;

            if (!isset($this->data[$last_element]["id"])) {
                $this->data[$last_element][$name] = $value;
                return;
            }
        }
        $this->data[] = [$name => $value];
    }

    public function save(): void
    {
        $this->prepareDataBeforeSave();
        $json_content = json_encode($this->data, JSON_PRETTY_PRINT);
        file_put_contents($this->path_to_file, $json_content);
    }

    public function update(int $id, array $data): void
    {
        foreach ($this->data as $key => &$value) {
            if ($value["id"] == $id) {
                foreach ($this->keys as $key) {
                    if (isset($data[$key])) $value[$key] = $data[$key];
                }
            }
        }
        $json_content = json_encode($this->data, JSON_PRETTY_PRINT);
        file_put_contents($this->path_to_file, $json_content);
    }

    public function delete(int $id): void
    {
        try {
            $this->data = array_filter($this->data, function ($item) use ($id) {
                return $item['id'] !== $id;
            });
            $json_content = json_encode($this->data, JSON_PRETTY_PRINT);
            file_put_contents($this->path_to_file, $json_content);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get(): array
    {
        return $this->data;
    }

    public function where(string $associated_field_name, mixed $associated_field_value)
    {
        $this->associated_field_name = $associated_field_name;
        $this->associated_field_value = $associated_field_value;
        return $this;
    }
}
