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

	public function getArmSize(): string {
		return strval($this->clientData[1]["ArmSize"]);
	}

	public function getCapeData(): string {
		return strval($this->clientData[1]["CapeData"]);
	}

	public function getCapeId(): string {
		return strval($this->clientData[1]["CapeId"]);
	}

	public function getCapeImageHeight(): int {
		return intval($this->clientData[1]["CapeImageHeight"]);
	}

	public function getCapeImageWidth(): int {
		return intval($this->clientData[1]["CapeImageWidth"]);
	}

	public function isCapeOnClassicSkin(): bool {
		return boolval($this->clientData[1]["CapeOnClassicSkin"]);
	}

	public function getClientRandomId(): int {
		return intval($this->clientData[1]["ClientRandomId"]);
	}

	public function getCurrentInputMode(): int {
		return intval($this->clientData[1]["CurrentInputMode"]);
	}

	public function getDefaultInputMode(): int {
		return intval($this->clientData[1]["DefaultInputMode"]);
	}

	public function getDeviceId(): string {
		return strval($this->clientData[1]["DeviceId"]);
	}

	public function getDeviceModel(): string {
		return strval($this->clientData[1]["DeviceModel"]);
	}

	public function getDeviceOS(): int {
		return intval($this->clientData[1]["DeviceOS"]);
	}

	public function getGameVersion(): string {
		return strval($this->clientData[1]["GameVersion"]);
	}

	public function getGuiScale(): int {
		return intval($this->clientData[1]["GuiScale"]);
	}

	public function isEditorMode(): bool {
		return boolval($this->clientData[1]["IsEditorMode"]);
	}

	public function getLanguageCode(): string {
		return strval($this->clientData[1]["LanguageCode"]);
	}

	public function isOverrideSkin(): bool {
		return boolval($this->clientData[1]["OverrideSkin"]);
	}

	// TODO: PersonaPieces

	public function isPersonaSkin(): bool {
		return boolval($this->clientData[1]["PersonaSkin"]);
	}

	// TODO: PieceTintColors

	public function getPlatformOfflineId(): string {
		return strval($this->clientData[1]["PlatformOfflineId"]);
	}

	public function getPlatformOnlineId(): string {
		return strval($this->clientData[1]["PlatformOnlineId"]);
	}

	public function getPlayFabId(): string {
		return strval($this->clientData[1]["PlayFabId"]);
	}

	public function isPremiumSkin(): bool {
		return boolval($this->clientData[1]["PremiumSkin"]);
	}

	public function getSelfSignedId(): string {
		return strval($this->clientData[1]["SelfSignedId"]);
	}

	public function getServerAddress(): string {
		return strval($this->clientData[1]["ServerAddress"]);
	}

	public function getSkinAnimationData(): string {
		return strval($this->clientData[1]["SkinAnimationData"]);
	}

	public function getSkinColor(): string {
		return strval($this->clientData[1]["SkinColor"]);
	}

	public function getSkinData(): string {
		return strval($this->clientData[1]["SkinData"]);
	}

	public function getSkinGeometryData(): string {
		return strval($this->clientData[1]["SkinGeometryData"]);
	}

	public function getSkinGeometryDataEngineVersion(): string {
		return strval($this->clientData[1]["SkinGeometryDataEngineVersion"]);
	}

	public function getSkinId(): string {
		return strval($this->clientData[1]["SkinId"]);
	}

	public function getSkinImageHeight(): string {
		return strval($this->clientData[1]["SkinImageHeight"]);
	}

	public function getSkinImageWidth(): string {
		return strval($this->clientData[1]["SkinImageWidth"]);
	}

	public function getSkinResourcePatch(): string {
		return strval($this->clientData[1]["SkinResourcePatch"]);
	}

	public function getThirdPartyName(): string {
		return strval($this->clientData[1]["ThirdPartyName"]);
	}

	public function isThirdPartyNameOnly(): bool {
		return boolval($this->clientData[1]["ThirdPartyNameOnly"]);
	}

	public function isTrustedSkin(): bool {
		return boolval($this->clientData[1]["TrustedSkin"]);
	}

	public function getUIProfile(): int {
		return intval($this->clientData[1]["UIProfile"]);
	}
}
