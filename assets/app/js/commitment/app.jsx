import { render } from 'react-dom';
import React from "react";
import { Provider } from 'react-redux';
import { store } from './store';
import Main from "./containers/MainContainer";

render(
    <Provider store={store}>
        <Main/>
    </Provider>,
    document.getElementById('root')
);