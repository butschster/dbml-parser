<?php
declare(strict_types=1);

namespace Butschster\Dbml;

use Butschster\Dbml\Schema\Project;
use Butschster\Dbml\Schema\Table;
use JsonSerializable;

class Schema implements JsonSerializable
{
    private ?Project $project = null;
    private array $tables = [];
    private array $enums = [];


    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    public function addTable(Table $table): void
    {
        $this->tables[] = $table;
    }

    public function jsonSerialize()
    {
        return [
            'project' => $this->project->jsonSerialize(),
            'tables' => array_map(
                fn(Table $table) => $table->jsonSerialize(),
                $this->tables
            ),
        ];
    }
}
