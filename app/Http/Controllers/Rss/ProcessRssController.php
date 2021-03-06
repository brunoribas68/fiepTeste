<?php

namespace App\Http\Controllers\Rss;

use App\Http\Controllers\Controller;
use FeedReader;
use App\Models\Rss;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;


class ProcessRssController extends Controller
{
    /**
     * Read a Rss from a valid link
     * 
     * @return \Inertia\Response
    */
    public function readRss(){
        $rsss = Rss::get();
        if($rsss->count() == 0){
            return Inertia::render('Dashboard',[
                'noticias' => []
            ]);
        }

        foreach($rsss as $rss){
            $feed = FeedReader::read($rss->rss);
            $noticias = [];
            foreach ($feed->get_items() as $f) {
                $noticias[] = [
                    'title' => $f->get_title(),
                    'content' => $f->get_content(),
                    'author' => $f->get_author(),
                    'data' => date("d-m-Y h:i:s", strtotime($f->get_date())),
                    'tema' => $this->themeClassifier($f->get_content()),
                    'sentimento' => $this->sentimentalClassifier($f->get_content())
                ];
            }
        }
        return Inertia::render('Dashboard',[
            'noticias' => $noticias
        ]);

    }
    /**
     * Indentify a theme from a text(in this case a news text)
     * @param  String $texto 
     * @return Array from a API
    */
    public function themeClassifier($texto){
        $response = Http::attach(
            'key', env('MEANING_KEY')
        )->attach(
            'txt', $texto
        )->attach(
            'model', env('MEANING_MODEL')
        )->timeout(60)->post(env('MEANING_HOST')."class-2.0");
        return $response->json()["category_list"][0]['label'];
    }
    /**
     * Indentify a sentimental in the given text(in this case a news text)
     * @param  String $texto 
     * @return Array from a API
    */
    public function sentimentalClassifier($texto){
        $response = Http::attach(
            'key', env('MEANING_KEY')
        )->attach(
            'txt', $texto
        )->attach(
            'lang', 'pt'
        )->attach(
            'ilang', 'pt'
        )->timeout(60)->post(env('MEANING_HOST')."sentiment-2.1");

        $response = $response->json();
        $classificacao = [
            'sentimento' => '',
            'resumo' => $response["sentence_list"][0]["text"]
        ];

        switch($response["score_tag"]){
                case'P+':
                    $classificacao['sentimento'] =  'completamente positiva';
                    break;
                case'P':
                    $classificacao['sentimento'] =  'parcialmente positiva';
                    break;
                case'NEU':
                    $classificacao['sentimento'] =  'neutra';
                    break;
                case'N':
                    $classificacao['sentimento'] =  'parcialmente negativa';
                    break;
                case'N+':
                    $classificacao['sentimento'] =  'completamente negativa';
                    break;
                case'NONE':
                    $classificacao['sentimento'] =  'indefinida';
                    break;
                default:
                    $classificacao['sentimento'] =  'Erro ao definir';
                    break;

        }
        return $classificacao;
    }
}
