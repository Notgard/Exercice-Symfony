<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table(name="film", indexes={@ORM\Index(name="FK_ILLUSTRER", columns={"IDIMAGE"})})
 * @ORM\Entity
 */
class Film
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDFILM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfilm;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE", type="string", length=256, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=256, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="LIKES", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $likes;

    /**
     * @var int
     *
     * @ORM\Column(name="DISLIKES", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $dislikes;

    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IDIMAGE", referencedColumnName="IDIMAGE")
     * })
     */
    private $idimage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="idfilm")
     */
    private $iduser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->iduser = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdfilm(): ?int
    {
        return $this->idfilm;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    public function setDislikes(int $dislikes): self
    {
        $this->dislikes = $dislikes;

        return $this;
    }

    public function getIdimage(): ?Image
    {
        return $this->idimage;
    }

    public function setIdimage(?Image $idimage): self
    {
        $this->idimage = $idimage;

        return $this;
    }

    public function setIdfilm(int $idfilm): self
    {
        $this->idfilm = $idfilm;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getIduser(): Collection
    {
        return $this->iduser;
    }

    public function addIduser(Utilisateur $iduser): self
    {
        if (!$this->iduser->contains($iduser)) {
            $this->iduser[] = $iduser;
            $iduser->addIdfilm($this);
        }

        return $this;
    }

    public function removeIduser(Utilisateur $iduser): self
    {
        if ($this->iduser->removeElement($iduser)) {
            $iduser->removeIdfilm($this);
        }

        return $this;
    }

}
