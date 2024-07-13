<?php

namespace Mir\TruthWhisper\model;

namespace Mir\TruthWhisper\model;

use Mir\TruthWhisper\trait\ModelHelperTrait;

class Model
{
    use ModelHelperTrait;

    private string $path_to_file;
    private array $data;
    private string $file_name;

    public function __construct(string $file_name)
    {
        $this->path_to_file = dirname(__DIR__) . "/file_storage/" . $file_name . ".json";
        $this->file_name = $file_name;
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
}
