<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="commentdate", type="date", nullable=false)
     */
    private $commentdate;

    /**
     * @ORM\Column(type="integer")
     */
    private $likecount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentcontent;





    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="comments")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="usercomments")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }





    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCommentdate(): ?\DateTime
    {
        return $this->commentdate;
    }

    public function setCommentdate(\DateTime $commentdate): self
    {
        $this->commentdate = $commentdate;

        return $this;
    }

    public function getLikecount(): ?int
    {
        return $this->likecount;
    }

    public function setLikecount(int $likecount): self
    {
        $this->likecount = $likecount;

        return $this;
    }

    public function getCommentcontent(): ?string
    {
        return $this->commentcontent;
    }

    public function setCommentcontent(string $commentcontent): self
    {
        $this->commentcontent = $commentcontent;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}
