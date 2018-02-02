<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Unirest\Request as Http;
use App\Services\DataParser;

class GithubController extends Controller
{
    private $baseUrl;
    private $apiHeaders;

    public function __construct()
    {
        $this->baseUrl = "https://api.github.com/repos";
        $this->apiHeaders = array("Accept" => "application/json");
        $this->dataParser = new DataParser();
    }
    /**
     * @Route("/github", name="github")
     */
    public function index(Request $req): Response
    {
        $user = $req->get('user');
        $repository = $req->get('repository');
        $url = join("/", array(
            $this->baseUrl,
            $user,
            $repository,
            "commits"
        ));
        $params = array(
            "until" => null !== $req->get('until') ? $req->get('until') : date(DATE_ATOM)
        );

        $data = Http::get($url, $this->apiHeaders, $params);

        $response = new Response();
        $response->setContent(json_encode(array(
            'data' => $data
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
