<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use pocketmine\network\mcpe\JwtUtils;

class Jwt {

	/** @param array{mixed[], mixed[], string} $clientData */
	public function __construct(private array $clientData) {
	}

	public static function parse(string $clientDataJwt): self {
		$clienData = JwtUtils::parse($clientDataJwt);
		return new self($clienData);
	}

	public function getalg(): string {
		return strval($this->clientData[0]["alg"]);
	}

	public function getx5u(): string {
		return strval($this->clientData[0]["x5u"]);
	}

	// TODO: AnimatedImageData
}
