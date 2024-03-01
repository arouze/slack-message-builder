<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\VideoBlock;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("VideoBlock")]
#[Group("Blocks")]
class VideoBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testVideoBlock(): void
    {
        $altText = $this->fakerGenerator->text();
        $title = self::buildTextObject();
        $thumbnailUrl = $this->fakerGenerator->imageUrl();
        $videoUrl = $this->fakerGenerator->url();

        self::assertEquals(
            [
                'type' => 'video',
                'alt_text' => $altText,
                'title' => $title->toArray(),
                'thumbnail_url' => $thumbnailUrl,
                'video_url' => $videoUrl
            ],
            (new VideoBlock())
            ->setAltText($altText)
            ->setTitle($title)
            ->setThumbnailUrl($thumbnailUrl)
            ->setVideoUrl($videoUrl)
            ->toArray()
        );
    }

    public function testVideoBlockWithAuthorName(): void
    {
        $altText = $this->fakerGenerator->text();
        $authorName = $this->fakerGenerator->text(50);
        $title = self::buildTextObject();
        $thumbnailUrl = $this->fakerGenerator->imageUrl();
        $videoUrl = $this->fakerGenerator->url();
        self::assertEquals(
            [
                'type' => 'video',
                'alt_text' => $altText,
                'title' => $title->toArray(),
                'author_name' => $authorName,
                'thumbnail_url' => $thumbnailUrl,
                'video_url' => $videoUrl
            ],
            (new VideoBlock())
                ->setAltText($altText)
                ->setTitle($title)
                ->setAuthorName($authorName)
                ->setThumbnailUrl($thumbnailUrl)
                ->setVideoUrl($videoUrl)
                ->toArray()
        );
    }

    public function testVideoBlockWithDescription(): void
    {
        $altText = $this->fakerGenerator->text();
        $title = self::buildTextObject();
        $description = self::buildTextObject();
        $thumbnailUrl = $this->fakerGenerator->imageUrl();
        $videoUrl = $this->fakerGenerator->url();

        self::assertEquals(
            [
                'type' => 'video',
                'title' => $title->toArray(),
                'alt_text' => $altText,
                'thumbnail_url' => $thumbnailUrl,
                'video_url' => $videoUrl,
                'description' => $description->toArray()
            ],
            (new VideoBlock())
                ->setAltText($altText)
                ->setTitle($title)
                ->setDescription($description)
                ->setThumbnailUrl($thumbnailUrl)
                ->setVideoUrl($videoUrl)
                ->toArray()
        );
    }

    public function testVideoBlockWithProviderIconUrl(): void
    {
        $altText = $this->fakerGenerator->text();
        $title = self::buildTextObject();
        $providerIconUrl = $this->fakerGenerator->imageUrl();
        $thumbnailUrl = $this->fakerGenerator->imageUrl();
        $videoUrl = $this->fakerGenerator->url();
        self::assertEquals(
            [
                'type' => 'video',
                'alt_text' => $altText,
                'title' => $title->toArray(),
                'provider_icon_url' => $providerIconUrl,
                'thumbnail_url' => $thumbnailUrl,
                'video_url' => $videoUrl
            ],
            (new VideoBlock())
                ->setAltText($altText)
                ->setTitle($title)
                ->setProviderIconUrl($providerIconUrl)
                ->setThumbnailUrl($thumbnailUrl)
                ->setVideoUrl($videoUrl)
                ->toArray()
        );
    }

    public function testVideoBlockWithProviderName(): void
    {
        $altText = $this->fakerGenerator->text();
        $title = self::buildTextObject();
        $providerName = $this->fakerGenerator->text();
        $thumbnailUrl = $this->fakerGenerator->imageUrl();
        $videoUrl = $this->fakerGenerator->url();
        self::assertEquals(
            [
                'type' => 'video',
                'alt_text' => $altText,
                'title' => $title->toArray(),
                'provider_name' => $providerName,
                'thumbnail_url' => $thumbnailUrl,
                'video_url' => $videoUrl
            ],
            (new VideoBlock())
                ->setAltText($altText)
                ->setTitle($title)
                ->setProviderName($providerName)
                ->setThumbnailUrl($thumbnailUrl)
                ->setVideoUrl($videoUrl)
                ->toArray()
        );
    }

    public function testVideoBlockWithTitleUrl(): void
    {
        $altText = $this->fakerGenerator->text();
        $title = self::buildTextObject();
        $titleUrl = $this->fakerGenerator->imageUrl();
        $thumbnailUrl = $this->fakerGenerator->imageUrl();
        $videoUrl = $this->fakerGenerator->url();
        self::assertEquals(
            [
                'type' => 'video',
                'alt_text' => $altText,
                'title' => $title->toArray(),
                'title_url' => $titleUrl,
                'thumbnail_url' => $thumbnailUrl,
                'video_url' => $videoUrl
            ],
            (new VideoBlock())
                ->setAltText($altText)
                ->setTitle($title)
                ->setTitleUrl($titleUrl)
                ->setThumbnailUrl($thumbnailUrl)
                ->setVideoUrl($videoUrl)
                ->toArray()
        );
    }

    public function testMissingAltTextException(): void
    {
        self::expectException(MissingFieldException::class);

        (new VideoBlock())
            ->setTitle(self::buildTextObject())
            ->setVideoUrl($this->fakerGenerator->url())
            ->setThumbnailUrl($this->fakerGenerator->imageUrl)
            ->toArray();
    }

    public function testMissingTitleException(): void
    {
        self::expectException(MissingFieldException::class);

        (new VideoBlock())
            ->setAuthorName($this->fakerGenerator->text())
            ->setVideoUrl($this->fakerGenerator->url())
            ->setThumbnailUrl($this->fakerGenerator->imageUrl)
            ->toArray();
    }

    public function testMissingThumbnailUrlException(): void
    {
        self::expectException(MissingFieldException::class);

        (new VideoBlock())
            ->setTitle(self::buildTextObject())
            ->setAuthorName($this->fakerGenerator->text())
            ->setVideoUrl($this->fakerGenerator->url())
            ->toArray();
    }

    public function testMissingVideoUrlException(): void
    {
        self::expectException(MissingFieldException::class);

        (new VideoBlock())
            ->setTitle(self::buildTextObject())
            ->setAuthorName($this->fakerGenerator->text())
            ->setThumbnailUrl($this->fakerGenerator->imageUrl)
            ->toArray();
    }

    public function testTooLongAuthorNameException(): void
    {
        self::expectException(TooLongTextException::class);

        $authorName = $this->fakerGenerator->realTextBetween(51);

        (new VideoBlock())
            ->setAltText($this->fakerGenerator->text())
            ->setAuthorName($authorName)
            ->toArray();
    }

    public function testTooLongDescriptionException(): void
    {
        self::expectException(TooLongTextException::class);

        $description = self::buildTextObject();
        $description->setText($this->fakerGenerator->realTextBetween(201, 250));

        (new VideoBlock())
            ->setAltText($this->fakerGenerator->text())
            ->setDescription($description)
            ->toArray();
    }
}
