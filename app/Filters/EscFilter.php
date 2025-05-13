<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class EscFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Sanitize POST data
        $postData = $request->getPost();
        $sanitizedData = [];
        foreach ($postData as $key => $value) {
            $sanitizedData[$key] = is_array($value) ? array_map('esc', $value) : esc($value);
        }

        // Replace the post data with sanitized data
        $request->setGlobal('post', $sanitizedData);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No changes needed after request
    }
}
