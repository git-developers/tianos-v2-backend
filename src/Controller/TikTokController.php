<?php

namespace App\Controller;

use App\Entity\TiktokFeed;
use App\Repository\TiktokFeedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * @Route("/tik-tok")
 */
class TikTokController extends AbstractController
{
    /**
     * @Route("/feed", name="list?api", methods={"GET", "POST"})
     */
    public function index(Request $request, TiktokFeedRepository $tiktokFeedRepository)
    {
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
        }

        $ch = curl_init();
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
        );
        curl_setopt($ch, CURLOPT_URL, "https://api.tiktokv.com/aweme/v1/feed/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $body = '{}';

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $authToken = curl_exec($ch);

        $a = json_decode($authToken);

        $ids = [];
        foreach ($a->aweme_list as $value) {

            $tiktokFeed = $tiktokFeedRepository->findOneByAwemeId($value->aweme_id);

            if (!is_null($tiktokFeed)) {
                continue;
            }

            $a = new TiktokFeed();
            $a->setAwemeId($value->aweme_id);
            $a->setUrlList($value->video->play_addr->url_list[2]);
            $a->setAuthorUid($value->author->uid);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($a);
            $entityManager->flush();
            $ids[] = $value->aweme_id;
        }

        return $this->json([
            "count" => count($ids),
            "aweme_ids" => $ids,
            "author_nickname" => $value->author->nickname,
            "author_signature" => $value->author->signature
        ]);
    }

    /**
     * @Route("/list", name="list2", methods={"GET", "POST"})
     */
    public function index2(Request $request, TiktokFeedRepository $tiktokFeedRepository)
    {
        $tiktokFeed = $tiktokFeedRepository->findAll();

        $out = [];
        foreach ($tiktokFeed as $value) {
            $url = $value->getUrlList();
            $nickname = $value->getAwemeId();
            $author_id = $value->getAuthorUid();
            $out[]= ([
                "url" => $url,
                "aweme_id" => $nickname,
                "author_id" => $author_id



            ]);
        }

        return $this->json(
            [
                "status" => "1",
                "message" => "",
                "items" => $out
            ]
        );
    }
}


