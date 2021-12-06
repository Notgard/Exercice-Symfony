<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="FK_POSSEDER", columns={"IDFILM"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDCOMMENTAIRE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENU", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var bool
     *
     * @ORM\Column(name="LIKED", type="boolean", nullable=false)
     */
    private $liked;

    /**
     * @var bool
     *
     * @ORM\Column(name="DISLIKED", type="boolean", nullable=false)
     */
    private $disliked;

    /**
     * @var \Film
     *
     * @ORM\ManyToOne(targetEntity="Film")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IDFILM", referencedColumnName="IDFILM")
     * })
     */
    private $idfilm;

    public function getIdcommentaire(): ?int
    {
        return $this->idcommentaire;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getLiked(): ?bool
    {
        return $this->liked;
    }

    public function setLiked(bool $liked): self
    {
        $this->liked = $liked;

        return $this;
    }

    public function getDisliked(): ?bool
    {
        return $this->disliked;
    }

    public function setDisliked(bool $disliked): self
    {
        $this->disliked = $disliked;

        return $this;
    }

    public function getIdfilm(): ?Film
    {
        return $this->idfilm;
    }

    public function setIdfilm(?Film $idfilm): self
    {
        $this->idfilm = $idfilm;

        return $this;
    }


}
