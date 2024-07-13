<?php

namespace Mir\TruthWhisper\trait;

trait ModelHelperTrait
{
    public array $keys;
    public int $original_length_of_mapped_data;

    public function getJsonData(): void
    {
        try {
            $json = file_get_contents($this->path_to_file);
            $this->json_data = json_decode($json, true);
            var_dump($this->json_data);
            $this->keys = array_keys(end($this->json_data));
            $this->length = count($this->json_data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // public function mapJsonDataInArray(): void
    // {

    //     // foreach ($this->json_data as $seek_key => $data) {
    //     //     var_dump($data);
    //     //     var_dump($data[$keys[$seek_key]]);
    //     // }

    //     foreach ($this->json_data as $data) {
    //         $this->mapped_data[] = $data;
    //     }
    //     var_dump($this->mapped_data);
    // }
}
