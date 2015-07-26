<?php

use Gistlog\Gists\GistConfig;

class GistConfigTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubGist = $this->loadFixture('8f5ea4d44dbc5ccb77a3.json');

        $config = GistConfig::fromGitHub($githubGist);

        $this->assertEquals("A test preview.", $config['preview']);
        $this->assertEquals("05-15-2015", $config['published_on']);
        $this->assertTrue($config['published']);
    }

    /** @test */
    public function it_returns_default_values_when_no_gistlog_yml_is_present()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');

        $config = GistConfig::fromGitHub($githubGist);

        $this->assertNull($config['preview']);
        $this->assertNull($config['published_on']);
        $this->assertFalse($config['published']);
    }

//    /** @test */
    public function it_returns_default_values_when_gistlog_yml_does_not_provide_them()
    {
        $githubGist = $this->loadFixture('9e5ea4d44dbc5ccb77b4.json');

        $config = GistConfig::fromGitHub($githubGist);

        $this->assertNull($config['preview']); // excluded
        $this->assertFalse($config['published']); // excluded
        $this->assertEquals("05-15-2015", $config['published_on']); // provided
    }
}
