import {
    COREVALUES_FETCH_STARTED,
    COREVALUES_FETCH_DONE,
    COREVALUES_FETCH_FAILED,
} from '../actions/filterCoreValuesActions';
import {COMMITMENTS_LIST_UPDATE_DONE, COMMITMENTS_LIST_UPDATE_STARTED} from "../actions/updateCommitmentsListActions";

const INITIAL_STATE = {
    coreValues: [],
    currentCoreValue: null,
    commitments: [],
    isLoading: false
};

export default function (state = INITIAL_STATE, action) {
    switch (action.type) {
        case COREVALUES_FETCH_STARTED:
        case COMMITMENTS_LIST_UPDATE_STARTED:
            return Object.assign({}, state, {
                isLoading: true
            });
        case COREVALUES_FETCH_DONE:
            return {
                ...state,
                "coreValues": action.coreValues,
                "commitments": action.commitments,
            };
        case COREVALUES_FETCH_FAILED:
            return Object.assign({}, state, {
                isLoading: false
            });
        case COMMITMENTS_LIST_UPDATE_DONE:
            let currentCoreValue = action.currentCoreValue;
            if (currentCoreValue === state.currentCoreValue) {
                currentCoreValue = null;
            }
            return {
                ...state,
                "commitments": action.commitments,
                "currentCoreValue": currentCoreValue,
                "isLoading": false
            };
        default:
            return state;
    }
}
