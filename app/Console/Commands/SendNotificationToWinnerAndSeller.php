<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Auction;
use App\Mail\YouHaveWonAnAuction;
use App\Mail\YourAuctionHasEnded;
use App\Mail\YourAuctionHaveWinner;
use Mail;
use App\Notification;

class SendNotificationToWinnerAndSeller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNotificationToWinnerAndSeller:sendnotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Notification to Winner of the auction (if exists) and the product seller about the winner.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $auctions = Auction::where('enddate','<',\Carbon\Carbon::now())->doesntHave('notifications')->get();
        foreach ($auctions as $auction) {
            $notification = new Notification;
            $notification->user_id = $auction->auction_seller->id;
            $notification->auction_id = $auction->id;
            $notification->save();
            if($auction->has_winner){
                Mail::to($auction->auction_seller->email)->send(new YourAuctionHaveWinner("None (This is an automated message)",$auction));
                Mail::to($auction->auction_winner->email)->send(new YouHaveWonAnAuction("None (This is an automated message)",$auction));
                $winnerNotification = new Notification;
                $winnerNotification->user_id = $auction->auction_winner->id;
                $winnerNotification->auction_id = $auction->id;
                $winnerNotification->save();
            }
            else{
                Mail::to($auction->auction_seller->email)->send(new YourAuctionHasEnded($auction));
            }
        }
    }
}
