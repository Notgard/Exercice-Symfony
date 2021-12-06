<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", indexes={@ORM\Index(name="FK_AVOIR_UN_AVATAR", columns={"IDIMAGE"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDUSER", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=50, nullable=false)
     */
    private $login;

    /**
     * @var int
     *
     * @ORM\Column(name="PASSWORD", type="integer", nullable=false)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="GENRE", type="integer", nullable=false)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=128, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="LASTNAME", type="string", length=128, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRSTNAME", type="string", length=128, nullable=false)
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="BIRTH", type="date", nullable=false)
     */
    private $birth;

    /**
     * @var string
     *
     * @ORM\Column(name="PHONENUMBER", type="string", length=15, nullable=false)
     */
    private $phonenumber;

    /**
     * @var \Image
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
     * @ORM\ManyToMany(targetEntity="Film", inversedBy="iduser")
     * @ORM\JoinTable(name="favorie",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IDUSER", referencedColumnName="IDUSER")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="IDFILM", referencedColumnName="IDFILM")
     *   }
     * )
     */
    private $idfilm;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idfilm = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?int
    {
        return $this->password;
    }

    public function setPassword(int $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

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

    /**
     * @return Collection|Film[]
     */
    public function getIdfilm(): Collection
    {
        return $this->idfilm;
    }

    public function addIdfilm(Film $idfilm): self
    {
        if (!$this->idfilm->contains($idfilm)) {
            $this->idfilm[] = $idfilm;
        }

        return $this;
    }

    public function removeIdfilm(Film $idfilm): self
    {
        $this->idfilm->removeElement($idfilm);

        return $this;
    }

}
