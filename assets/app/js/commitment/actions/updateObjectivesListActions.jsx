export const OBJECTIVES_LIST_UPDATE_STARTED = 'objectives_list_started';
export const OBJECTIVES_LIST_UPDATE_DONE = 'objectives_list_done';

export const updateObjectivesList = (barData, coreValues) => dispatch => {
    dispatch({
        type: OBJECTIVES_LIST_UPDATE_STARTED
    });
    let coreValue = barData.data[barData.index];
    dispatch({
        type: OBJECTIVES_LIST_UPDATE_DONE,
        objectives: coreValue.objectives,
        coreValues: coreValues,
        currentCoreValue: coreValue.x
    });
};
