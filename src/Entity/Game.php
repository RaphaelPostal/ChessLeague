<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    const SURREND = 'Abandon',
          MATE = 'Mat',
          DRAW_AGREE = 'Nulle (accord)',
          DRAW_PAT = 'Nulle (pat)',
          DRAW_REP = 'Nulle (répétition)';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="gamesWon")
     */
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="WhiteGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Blancs;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="BlackGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Noirs;

    /**
     * @ORM\Column (type="string")
     * @ORM\JoinColumn(nullable=false)
     */
    private $end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWinner(): ?player
    {
        return $this->winner;
    }

    public function setWinner(?player $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getBlancs(): ?Player
    {
        return $this->Blancs;
    }

    public function setBlancs(?Player $Blancs): self
    {
        $this->Blancs = $Blancs;

        return $this;
    }

    public function getNoirs(): ?Player
    {
        return $this->Noirs;
    }

    public function setNoirs(?Player $Noirs): self
    {
        $this->Noirs = $Noirs;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end): void
    {
        $this->end = $end;
    }
}
