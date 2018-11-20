import { combineReducers } from "redux";

import filterCoreValuesReducer from './filterCoreValuesReducer';

// main reducers
export const reducers = combineReducers({
    filterCoreValues: filterCoreValuesReducer
});
