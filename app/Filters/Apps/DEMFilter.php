<?php

namespace App\Filters\Apps;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class DEMFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session('role_id') || !session('tkn') || session('tkn') !== base64_encode(session('name'))) {
            return redirect()->to(base_url());
        } else {
            if (base64_decode(session('role_id')) <> 2) {
                return redirect()->to(base_url());
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
