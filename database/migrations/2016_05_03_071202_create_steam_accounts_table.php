<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSteamAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('steam_accounts', function(Blueprint $table) {
            $table->increments('id');
//            $table->string('api_key');
            //public data
            $table->string('trade_url')->nullable();            //url for account trading
            $table->string('steam_id');                         //"steamid" 64bit SteamID of the user
            $table->string('name')->nullable();                 //"personaname"
            $table->string('profile_url');                      //"profileurl"
            $table->string('avatar')->nullable();               //"avatar": 32x32
            $table->integer('status')->nullable();              //"personastate": 0 - Offline, 1 - Online, 2 - Busy, 3 - Away, 4 - Snooze, 5 - looking to trade, 6 - looking to play.
            $table->integer('visibility')->nullable();          //"communityvisibilitystate": 1 - the profile is not visible to you (Private, Friends Only, etc), 3 - the profile is "Public"
            $table->integer('profile_state')->nullable();       //"profilestate": If set, indicates the user has a community profile configured (will be set to '1')
            $table->timestamp('last_logoff')->nullable();       //"lastlogoff": If set, indicates the user has a community profile configured (will be set to '1')
            $table->integer('comment_permission')->nullable();  //"commentpermission": If set, indicates the profile allows public comments.
            //private data
            $table->string('real_name')->nullable();            //"realname": The player's "Real Name", if they have set it.
            $table->string('primary_group_id')->nullable();     //"primaryclanid": The player's primary group, as configured in their Steam Community profile.
            $table->timestamp('time_created')->nullable();      //"timecreated": The time the player's account was created.
            $table->string('game_id')->nullable();              //"gameid": If the user is currently in-game, this value will be returned and set to the gameid of that game.
            $table->string('gameserver_ip')->nullable();        //"gameserverip": The ip and port of the game server the user is currently playing on, if they are playing on-line in a game using Steam matchmaking. Otherwise will be set to "0.0.0.0:0".
            $table->string('loc_country_code')->nullable();     //"loccountrycode": If set on the user's Steam Community profile, The user's country of residence, 2-character ISO country code
            $table->string('loc_state_code')->nullable();       //"locstatecode": If set on the user's Steam Community profile, The user's state of residence
            $table->string('loc_city_id')->nullable();          //"loccityid": An internal code indicating the user's city of residence. A future update will provide this data in a more useful way.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('steam_accounts');
    }
}
