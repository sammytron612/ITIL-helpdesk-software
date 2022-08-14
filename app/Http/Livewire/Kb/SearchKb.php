<?php

namespace App\Http\Livewire\Kb;

use Livewire\Component;
use App\Models\dummyArticles;

class SearchKb extends Component
{
    public $searchTerm;
    public $selected;
    public $commentId;

    public function render()
    {
        $articles = [];

        if(strlen($this->searchTerm > 2))
        {
            $articles = dummyArticles::where('title', 'like' , '%' . $this->searchTerm . '%')->get();  
        }
        else
        {
            $this->reset('selected');
        }

        
        return view('livewire.kb.search-kb',['articles' => $articles]);

    }

    public function choice(dummyArticles $article)
    {
        $this->selected = $article;
    }

    public function clearData()
    {
        $this->reset();
    }
}