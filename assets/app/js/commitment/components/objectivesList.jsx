import React, {PureComponent, Fragment} from 'react';
import {List as Loader} from 'react-content-loader'
import ReactTable from "react-table";
import moment from "moment";
import UserAvatar from "./userAvatar.jsx"

class ObjectivesList extends PureComponent {
    constructor(props) {
        super(props);
    }
    render() {
        const {objectives} = this.props;
        if (objectives && objectives.length > 0) {
            return (
                <div>
                    <ReactTable
                        data={objectives}
                        defaultPageSize={10}
                        columns={[
                            {
                                Header: "Nom",
                                accessor: "name"
                            },
                            {
                                id: "accomplished",
                                Header: "Completion",
                                accessor: a => <Fragment>{a.accomplished ?"✅":null}</Fragment>
                            },
                            {
                                id: "plannedDate",
                                Header: "Date visée",
                                accessor: a => <Fragment>{moment(a.plannedDate.date).format('DD/MM/YYYY')}</Fragment>
                            },
                            {
                                id: "users",
                                Header: "Utilisateurs",
                                accessor: a => <Fragment>{_.map(a.users, (user) => {
                                    return <UserAvatar key={user.id} user={user}/>
                                })}</Fragment>
                            },
                        ]}
                        className="-striped -highlight">
                    </ReactTable>
                </div>
            );
        } else {
            return (
                <Loader />
            );
        }
    }
}

export default ObjectivesList;