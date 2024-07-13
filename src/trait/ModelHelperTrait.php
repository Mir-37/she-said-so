<?php

namespace Mir\TruthWhisper\trait;

use Exception;

trait ModelHelperTrait
{
    public array $keys = [];
    public int $length = 0;
    private array $mapped_data = [];

    public function getJsonData(): void
    {
        try {
            $json = file_get_contents($this->path_to_file);
            $this->data = json_decode($json, true);
            $this->keys = array_keys(end($this->data));
            $this->length = count($this->data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function prepareDataBeforeSave(): void
    {
        $latest_element = &$this->data[count($this->data) - 1];
        $new_data = [];
        // Ensure 'id' field is added at the beginning
        $new_data["id"] = $this->getLastId() + 1;

        foreach ($this->keys as $key) {
            if ($key !== 'id') {
                $new_data[$key] = array_key_exists($key, $latest_element) ? $latest_element[$key] : null;
            }
        };

        unset($this->data[count($this->data) - 1]);
        array_push($this->data, $new_data);
        $this->data = array_values($this->data);
        var_dump($this->data);
    }


    function getLastId(): int
    {
        return $this->data[$this->length - 1]["id"] ?? 0;
    }
}
