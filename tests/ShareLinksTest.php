<?php

namespace phpUnitTutorial\Test;

class ShareLinksTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->link = 'http://example.com';
        $this->image = 'http://example.com/image.jpg';
    }

    /**
     * @dataProvider providerTextNetworks
     */
    public function testTextOnlyNetworks($network, $expected)
    {
        $this->assertEquals(
            $expected,
            \xes\ShareLinks::URL($network, $this->link)
        );

        $this->assertEquals(
            $expected,
            \xes\ShareLinks::URL($network, $this->link, $this->image)
        );
    }

    /**
     * @dataProvider providerImageNetworks
     */
    public function testImageNetworks($network, $expected)
    {
        $this->assertEquals(
            $expected,
            \xes\ShareLinks::URL($network, $this->link, $this->image)
        );
    }

    /**
     * @dataProvider providerImageNetworks
     */
    public function testMissingImageThrowsException($network, $expected)
    {
        $this->setExpectedException('Exception', "Network '$network' requires an image");
        \xes\ShareLinks::URL($network, $this->link);
    }

    public function providerTextNetworks()
    {
        return [
            [
                'twitter',
                'http://twitter.com/home?status=http%3A%2F%2Fexample.com'
            ],
            [
                'facebook',
                'http://facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com'
            ],
            [
                'google-plus',
                 'http://plus.google.com/share?url=http%3A%2F%2Fexample.com'
            ],
        ];
    }

    public function providerImageNetworks()
    {
        return [
            [
                'pinterest',
                'http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fexample.com&media=http%3A%2F%2Fexample.com%2Fimage.jpg'
            ],
        ];
    }
}
