<?php

namespace App\Listeners\Data;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeletingNodeableRecord
{
  /**
   * Create the event listener.
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   */
  public function handle(object $event): void
  {
    /** @var \App\Models\Data\NodeableRecord $record */
    $record = $event->record;

    $record->nodeable->delete();
  }
}
