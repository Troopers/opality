export const COREVALUES_FETCH_STARTED = 'core_values_fetch_started';
export const COREVALUES_FETCH_DONE = 'core_values_fetch_done';
export const COREVALUES_FETCH_FAILED = 'core_values_fetch_failed';

import _ from 'lodash';
import {fetch as fetchPolyfill} from 'whatwg-fetch';
const routes = require('../../../../../public/js/fos_js_routes.json');
import Routing from '../../../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
Routing.setRoutingData(routes);

export const filterCoreValues = (data) => dispatch => {
    let params = [];
    if (data.length > 0) {
        let users = _.filter(_.map(data, (item) => {
            if (item.type === 'user') {
                return item.value;
            }
        }), function(o) { return o != undefined; });
        if (users.length > 0) {params["users"]= users;}
        let teams = _.filter(_.map(data, (item) => {
            if (item.type === 'team') {
                return item.value;
            }
        }), function(o) { return o != undefined; });
        if (teams.length > 0) {params["teams"]= teams;}
    }
    dispatch({
        type: COREVALUES_FETCH_STARTED,
    });
    let url = Routing.generate('api_coreValue_filterByObjectiveUsersOrTeams', params);
    fetchPolyfill(url)
        .then(response => {
            if (!response.ok) {
                throw Error("Network request failed");
            }

            return response
        })
        .then(data => data.json())
        .then(coreValues => {
            dispatch({
                type: COREVALUES_FETCH_DONE,
                coreValues: coreValues
            });
        })
        .catch(error => {
            dispatch({
                type: COREVALUES_FETCH_FAILED,
                payload: {
                    error: error,
                }
            });
        });

};
