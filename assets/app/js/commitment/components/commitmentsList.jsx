import React, {PureComponent, Fragment} from 'react';
import {List as Loader} from 'react-content-loader'
import ReactTable from "react-table";
import moment from "moment";
import UserAvatar from "./userAvatar.jsx"

class CommitmentsList extends PureComponent {
    constructor(props) {
        super(props);
    }
    render() {
        const {commitments} = this.props;
        if (commitments && commitments.length > 0) {
            return (
                <div>
                    <ReactTable
                        data={commitments}
                        defaultPageSize={10}
                        columns={[
                            {
                                Header: "Nom",
                                accessor: "name"
                            },
                            {
                                id: "commitments",
                                Header: "Objectifs",
                                accessor: a => <Fragment><ul>{_.map(a.commitments, (commitment) => {
                                    return <li>{commitment.name}</li>
                                })}</ul></Fragment>
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

export default CommitmentsList;