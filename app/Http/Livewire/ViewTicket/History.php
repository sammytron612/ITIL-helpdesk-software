<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;
use App\Models\status_history;

class History extends Component
{
    public $historyDrawer = false;
    public $incident;


    public function render()
    {
        
        $array = [];

        if($this->historyDrawer)
        {
            
            $histories = status_history::where('incident_id', $this->incident->id)->orderBy('created_at')->get();

         
            $count = count($histories);
            //dd($count);
            for($i = 1;$i < $count;$i++)
            {
           
                if($histories[$i]->assigned_to == $histories[$i-1]->assigned_to || $histories[$i]->assigned_group == $histories[$i-1]->assigned_group)
                {
                
                    $array[] = ['type' => 'status', 
                            'user' => $histories[$i]->actioned_by?->name, 
                            'agent' => $histories[$i]->assigned_agent?->name,
                            'group' => $histories[$i]->assigned_queue?->name,
                            'status' => $histories[$i]->status_name?->status,
                            'time' => $histories[$i]->created_at];
                }
                else 
                {
                    
                    // re assign
                    $array[] = ['type' => 'reassign', 
                        'user' => $histories[$i]->actioned_by?->name, 
                        'agent' => $histories[$i]->assigned_agent?->name,
                        'group' => $histories[$i]->assigned_queue?->name,
                        'status' => 'New',
                        'time' => $histories[$i]->created_at];
                        


                }
                
            }
           //dd($array); 
        }
        
        
        return view('livewire.view-ticket.history', ['histories' => $array]);
    }
}
