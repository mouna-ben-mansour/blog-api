<?php

namespace App\Serializer\Handler;

use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use App\Entity\Article;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\SerializationContext as Context;

class ArticleHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods(){
        return [
            [
                'direction'=> GraphNavigator::DIRECTION_SERIALIZATION,
                'format'=> 'json',
                'type'=>'App\Entity\Article',
                'method'=>'serialize',
            ]
            ];
    }
    public static function serialize(JsonSerializationVisitor $visitor, Article $article, array $type, Context $context){
        $date = new \Datetime();
        return [
           'title' => $article->getTitle(),
           'content' => $article->getContent(),
           'field' => $date->format('l jS \of F Y h:i:s A')
       ];
    }
}