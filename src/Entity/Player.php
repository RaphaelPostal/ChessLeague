<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="winner")
     */
    private $gamesWon;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="Blancs")
     */
    private $WhiteGames;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="Noirs")
     */
    private $BlackGames;

    public function __construct()
    {
        $this->gamesWon = new ArrayCollection();
        $this->WhiteGames = new ArrayCollection();
        $this->BlackGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGamesWon(): Collection
    {
        return $this->gamesWon;
    }

    public function addGamesWon(Game $gamesWon): self
    {
        if (!$this->gamesWon->contains($gamesWon)) {
            $this->gamesWon[] = $gamesWon;
            $gamesWon->setWinner($this);
        }

        return $this;
    }

    public function removeGamesWon(Game $gamesWon): self
    {
        if ($this->gamesWon->removeElement($gamesWon)) {
            // set the owning side to null (unless already changed)
            if ($gamesWon->getWinner() === $this) {
                $gamesWon->setWinner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getWhiteGames(): Collection
    {
        return $this->WhiteGames;
    }

    public function addWhiteGame(Game $whiteGame): self
    {
        if (!$this->WhiteGames->contains($whiteGame)) {
            $this->WhiteGames[] = $whiteGame;
            $whiteGame->setBlancs($this);
        }

        return $this;
    }

    public function removeWhiteGame(Game $whiteGame): self
    {
        if ($this->WhiteGames->removeElement($whiteGame)) {
            // set the owning side to null (unless already changed)
            if ($whiteGame->getBlancs() === $this) {
                $whiteGame->setBlancs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getBlackGames(): Collection
    {
        return $this->BlackGames;
    }

    public function addBlackGame(Game $blackGame): self
    {
        if (!$this->BlackGames->contains($blackGame)) {
            $this->BlackGames[] = $blackGame;
            $blackGame->setNoirs($this);
        }

        return $this;
    }

    public function removeBlackGame(Game $blackGame): self
    {
        if ($this->BlackGames->removeElement($blackGame)) {
            // set the owning side to null (unless already changed)
            if ($blackGame->getNoirs() === $this) {
                $blackGame->setNoirs(null);
            }
        }

        return $this;
    }
}
