<?php

namespace Mir\TruthWhisper\trait;

trait ModelHelperTrait
{
    public int $length = 0;

    public function getJsonData(): void
    {
        try {
            $json = file_get_contents($this->path_to_file);
            $this->data = json_decode($json, true) ?? [];
            $this->length = count($this->data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function prepareDataBeforeSave(): void
    {
        $latest_element = &$this->data[count($this->data) - 1];
        $new_data = [];
        $new_data["id"] = $this->getLastId() + 1;

        foreach ($this->keys as $key) {
            if ($key !== 'id') {
                $new_data[$key] = array_key_exists($key, $latest_element) ? $latest_element[$key] : null;
            }
        };

        unset($this->data[count($this->data) - 1]);
        array_push($this->data, $new_data);
        $this->data = array_values($this->data);
    }

    public function getLastId(): int
    {
        return $this->data[$this->length - 1]["id"] ?? 0;
    }

    public function write(): void
    {
        $json_content = json_encode($this->data, JSON_PRETTY_PRINT);
        file_put_contents($this->path_to_file, $json_content);
    }
}
