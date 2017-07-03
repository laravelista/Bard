<?php

namespace Laravelista\Bard\Traits;

use Symfony\Component\HttpFoundation\Response;

trait Renderer
{
    /**
     * @return Response
     */
    public function render()
    {
        return new Response($this->generate(), Response::HTTP_OK, [
            'Content-Type' => 'text/xml'
        ]);
    }
}
