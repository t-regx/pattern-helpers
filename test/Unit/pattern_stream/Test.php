<?php
namespace Test\Unit\pattern_stream;

use PHPUnit\Framework\TestCase;
use TRegx\Exception\MalformedPatternException;

class Test extends TestCase
{
    /**
     * @test
     */
    public function shouldMatchFirst()
    {
        // when
        $stream = pattern_stream('word', 'word');
        // then
        $this->assertSame('word', "{$stream->first()}");
    }

    /**
     * @test
     */
    public function shouldMatchWithModifiers()
    {
        // when
        $stream = pattern_stream('word', 'wOrD', 'i');
        // then
        $this->assertSame('wOrD', "{$stream->first()}");
    }

    /**
     * @test
     */
    public function shouldFailForMalformedPattern()
    {
        // then
        $this->expectException(MalformedPatternException::class);
        $this->expectExceptionMessage('Quantifier does not follow a repeatable item at offset 0');
        // when
        pattern_stream('?', 'subject')->first();
    }

    /**
     * @test
     */
    public function shouldFailForInvalidModifier()
    {
        // then
        $this->expectException(MalformedPatternException::class);
        $this->expectExceptionMessage("Unknown modifier 'f'");
        // when
        pattern_stream('pattern', 'subject', 'f')->first();
    }

    /**
     * @test
     */
    public function shouldMatchAll()
    {
        // when
        [$ours, $is, $the, $fury] = pattern_stream('\w+', 'Ours is the Fury')->all();
        // then
        $this->assertSame('Ours', "$ours");
        $this->assertSame('is', "$is");
        $this->assertSame('the', "$the");
        $this->assertSame('Fury', "$fury");
    }

    /**
     * @test
     */
    public function shouldGetOffsets()
    {
        // when
        [$ours, $is, $the, $fury] = pattern_stream('\w+', 'Ours is the Fury')->all();
        // then
        $this->assertSame(0, $ours->offset());
        $this->assertSame(5, $is->offset());
        $this->assertSame(8, $the->offset());
        $this->assertSame(12, $fury->offset());
    }
}
