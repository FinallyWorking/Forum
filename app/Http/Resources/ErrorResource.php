<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    private array $data = [];

    private string $message = '';

    private int $status = 400;

    public function __construct(array $data, int $status = 400)
    {
        $this->data = array_key_exists('data', $data) ? $data['data'] : [];
        $this->message = array_key_exists('message', $data) ? $data['message'] : '';
        $this->status = $status;
    }

    /**
     * Customize the response for a request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\JsonResponse  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->status);
        parent::withResponse($request, $response);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return new BaseResource($this->data, $this->message, $this->status);
    }
}
