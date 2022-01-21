<?php
namespace EventFarm\Marketo\Tests\Oauth;

use EventFarm\Marketo\Oauth\MarketoProvider;
use League\OAuth2\Client\Token\AccessToken;
use Kristenlk\OAuth2\Client\Provider\Marketo;
use PHPUnit\Framework\TestCase;

class MarketoProviderTest extends TestCase
{
    public function testLeagueAccessTokenFacade()
    {
        $myAccessToken = 'myAccessToken';
        $myExpiresIn = 1234567890;
        $myLastRefresh = 2345678901;
        $theLeagueAccessToken = \Mockery::mock(AccessToken::class);
        $theLeagueAccessToken->shouldReceive('getToken')->andReturn($myAccessToken);
        $theLeagueAccessToken->shouldReceive('getExpires')->andReturn($myExpiresIn);
        $theLeagueAccessToken->shouldReceive('getLastRefresh')->andReturn($myLastRefresh);
        $marketoProvider = \Mockery::mock(Marketo::class);
        $marketoProvider->shouldReceive('getAccessToken')
            ->andReturn($theLeagueAccessToken);
        $kristenlkMarketoProvider = new MarketoProvider($marketoProvider);
        $accessToken = $kristenlkMarketoProvider->getAccessToken('client_credentials');
        $this->assertInstanceOf(\EventFarm\Marketo\Oauth\AccessToken::class, $accessToken);
        $this->assertSame($myAccessToken, $accessToken->getToken());
        \Mockery::close();
    }
}
