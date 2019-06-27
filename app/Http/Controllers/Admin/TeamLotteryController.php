<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTeamLotteryRequest;
use App\Http\Requests\UpdateTeamLotteryRequest;
use App\Repositories\TeamLotteryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TeamLotteryController extends AppBaseController
{
    /** @var  TeamLotteryRepository */
    private $teamLotteryRepository;

    public function __construct(TeamLotteryRepository $teamLotteryRepo)
    {
        $this->teamLotteryRepository = $teamLotteryRepo;
    }

    /**
     * Display a listing of the TeamLottery.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->teamLotteryRepository->pushCriteria(new RequestCriteria($request));
        $teamLotteries = $this->teamLotteryRepository->all();

        return view('admin.team_lotteries.index')
            ->with('teamLotteries', $teamLotteries);
    }

    /**
     * Show the form for creating a new TeamLottery.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.team_lotteries.create');
    }

    /**
     * Store a newly created TeamLottery in storage.
     *
     * @param CreateTeamLotteryRequest $request
     *
     * @return Response
     */
    public function store(CreateTeamLotteryRequest $request)
    {
        $input = $request->all();

        $teamLottery = $this->teamLotteryRepository->create($input);

        Flash::success('Team Lottery saved successfully.');

        return redirect(route('teamLotteries.index'));
    }

    /**
     * Display the specified TeamLottery.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $teamLottery = $this->teamLotteryRepository->findWithoutFail($id);

        if (empty($teamLottery)) {
            Flash::error('Team Lottery not found');

            return redirect(route('teamLotteries.index'));
        }

        return view('admin.team_lotteries.show')->with('teamLottery', $teamLottery);
    }

    /**
     * Show the form for editing the specified TeamLottery.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $teamLottery = $this->teamLotteryRepository->findWithoutFail($id);

        if (empty($teamLottery)) {
            Flash::error('Team Lottery not found');

            return redirect(route('teamLotteries.index'));
        }

        return view('admin.team_lotteries.edit')->with('teamLottery', $teamLottery);
    }

    /**
     * Update the specified TeamLottery in storage.
     *
     * @param  int              $id
     * @param UpdateTeamLotteryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeamLotteryRequest $request)
    {
        $teamLottery = $this->teamLotteryRepository->findWithoutFail($id);

        if (empty($teamLottery)) {
            Flash::error('Team Lottery not found');

            return redirect(route('teamLotteries.index'));
        }

        $teamLottery = $this->teamLotteryRepository->update($request->all(), $id);

        Flash::success('Team Lottery updated successfully.');

        return redirect(route('teamLotteries.index'));
    }

    /**
     * Remove the specified TeamLottery from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teamLottery = $this->teamLotteryRepository->findWithoutFail($id);

        if (empty($teamLottery)) {
            Flash::error('Team Lottery not found');

            return redirect(route('teamLotteries.index'));
        }

        $this->teamLotteryRepository->delete($id);

        Flash::success('Team Lottery deleted successfully.');

        return redirect(route('teamLotteries.index'));
    }
}
