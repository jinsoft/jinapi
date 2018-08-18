/**
 * Imports the API URL from the config.
 */

import {CONFIG} from "../config";

export default {

    getCafes: function () {
        return axios.get(CONFIG.API_URL + '/cafes');
    },
    getCafe: function (cafeID) {
        return axios.get(CONFIG.API_URL + '/cafes/' + cafeID);
    },
    postAddNewCafe: function (name, address, city, state, zip) {
        return axios.post(CONFIG.API_URL + '/cafes',
            {
                name: name,
                address: address,
                city: city,
                state: state,
                zip: zip
            }
        );
    }
}