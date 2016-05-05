<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Components\UserSystem\User;
use App\Components\ContentManagementSystem\Content\Content;
use App\Components\ContentManagementSystem\Content\ContentModels\Article;
use App\Components\ContentManagementSystem\Node\Index\ContentCategory;

class ContentManagementSystemTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @return User
     */
    public function makeUser()
    {
        $user = (new User())->setEmail('test@test.com')->setName('test')->setPassword('123456');
        $user->save();

        return $user;
    }

    public function makeNode()
    {
        $node = new ContentCategory();
        $node->save();

        return $node;
    }

    public function testCreateArticle()
    {
        $now     = new DateTime();
        $nextDay = clone $now;
        $prevDay = clone $now;
        $nextDay->modify('+1 day');
        $prevDay->modify('-1 day');

        (new Article())->setAuthor('test')
                       ->setContent('test content')
                       ->setCover('cover')
                       ->setExpiredAt($prevDay)
                       ->save();

        (new Article())->setAuthor('test')
                       ->setContent('test content')
                       ->setCover('cover')
                       ->setExpiredAt(null)
                       ->save();

        (new Article())->setAuthor('test')
                       ->setContent('test content')
                       ->setCover('cover')
                       ->setExpiredAt($nextDay)
                       ->save();

        (new Article())->setAuthor('test')
                       ->setContent('test content')
                       ->setCover('cover')
                       ->setPublishedAt($nextDay)
                       ->save();

        $this->assertEquals(4, Article::count());
        $this->assertEquals(3, Article::withoutExpired($now)->count());
        $this->assertEquals(3, Article::published($now)->count());
        $this->assertEquals(2, Article::published($now)->withoutExpired($now)->count());
    }

    public function testCreateContent()
    {
        Auth::guard('site')->login($user = $this->makeUser());

        $content = new Content();
        $content->createModel(Article::class, function (Article $article) {
            $article->setAuthor('test')
                    ->setContent('test content')
                    ->setCover('cover');
        })->setName('test')->setTitle('test')->setNode($node = $this->makeNode())->setPublisher($user)->save();

        $this->assertEquals(1, Article::count());
        $article = Article::first();
        $this->seeInDatabase('contents', [
            'node_id'            => $node->id,
            'node_type'          => 'CMS\\' . class_basename($node),
            'publisher_id'       => $user->id,
            'publisher_type'     => 'UserSystem\\' . class_basename($user),
            'content_model_id'   => $article->id,
            'content_model_type' => 'CMS\\' . class_basename($article),
        ]);
    }
}
