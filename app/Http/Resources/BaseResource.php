<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    private array $data;

    private string $message;

    private int $status;

    public function __construct(array $data, string $message = '', int $status = 200)
    {
        $this->data = $data;
        $this->message = $message;
        $this->status = $status;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = $this->data ? $this->data : [];
        $response['status'] = $this->status;

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
