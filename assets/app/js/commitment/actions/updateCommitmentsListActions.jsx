export const COMMITMENTS_LIST_UPDATE_STARTED = 'commitments_list_started';
export const COMMITMENTS_LIST_UPDATE_DONE = 'commitments_list_done';

export const updateCommitmentsList = (barData, coreValues) => dispatch => {
    dispatch({
        type: COMMITMENTS_LIST_UPDATE_STARTED
    });
    let coreValue = barData.data[barData.index];
    dispatch({
        type: COMMITMENTS_LIST_UPDATE_DONE,
        commitments: coreValue.commitments,
        coreValues: coreValues,
        currentCoreValue: coreValue.x
    });
};
