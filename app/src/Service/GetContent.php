<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class GetContent
{

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function get(string $url, string $filter): array
    {
        try {
            $response = $this->client->request('GET', $url);
            $contents = $response->getContent();
            $crawler  = new Crawler($contents);

            return $crawler->filter($filter)->extract(['_text']);
            //TODO write to log and another catch
        } catch (TransportExceptionInterface $e) {
            return ['something wrong'];
        } catch (ClientExceptionInterface $e) {
            return ['something wrong'];
        } catch (RedirectionExceptionInterface $e) {
            return ['something wrong'];
        } catch (ServerExceptionInterface $e) {
            return ['something wrong'];
        }
    }
}
