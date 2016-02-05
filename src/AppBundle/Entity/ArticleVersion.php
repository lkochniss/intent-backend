<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ArticleVersion
 */
class ArticleVersion extends AbstractArticleModel
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @param Article $article Set article.
     * @return $this
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
