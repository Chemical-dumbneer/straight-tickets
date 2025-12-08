<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\TicketStoreRequest;
use App\Http\Requests\API\V1\TicketUpdateRequest;
use App\Http\Resources\V1\TicketResource;
use App\services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(
        private TicketService $ticketService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Ticket::class);

        $tickets = $this->ticketService->listForUser(auth()->user());

        return TicketResource::collection($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketStoreRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        $ticket = $this->ticketService->create(
            $validated['user_id'],
            $validated['title'],
            $validated['description'],
        );

        return (new TicketResource($ticket))
            ->response()
            ->setStatusCode(201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = $this->ticketService->findById($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado.'], 404);
        }

        $this->authorize('view', $ticket);

        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketUpdateRequest $request, string $id)
    {
        $ticket = $this->ticketService->findById($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado.'], 404);
        }

        $this->authorize('update', $ticket);

        $updated = $this->ticketService->update($id, $request->validated());

        return (new TicketResource($updated));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
