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
        // Substraction of six months (seconds) from the current timestamp
        $defaultSince = time() - 14515200;
        $params = array(
            "until" => null !== $req->get('until') ? $req->get('until') : date(DATE_ATOM),
            "since" => null !== $req->get('since') ? $req->get('since') : date(DATE_ATOM, $defaultSince)
        );

        $data = Http::get($url, $this->apiHeaders, $params);
        $parsedData = $this->dataParser->formatBody($data->body, time());

        $response = new Response();
        $response->setContent(json_encode($parsedData));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
