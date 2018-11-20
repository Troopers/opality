import React, {PureComponent} from "react";
import CoreValuesChart from './CoreValuesChartContainer'
import CommitmentsList from './CommitmentsListContainer'
import CoreValuesUserFilter from '../components/coreValuesUserFilter'
import {bindActionCreators} from "redux";
import {filterCoreValues} from "../actions/filterCoreValuesActions";
import {updateCommitmentsList} from "../actions/updateCommitmentsListActions";
import connect from "react-redux/es/connect/connect";

class Main extends PureComponent {
    constructor(props) {
        super(props);
        this.handleSelectChange = this.handleSelectChange.bind(this);
        this.handleBarClick = this.handleBarClick.bind(this);
    }
    componentDidMount() {
        this.props.actions.filterCoreValues([]);
    }
    handleSelectChange(selectState) {
        this.props.actions.filterCoreValues(selectState);
    }
    handleBarClick(barData, coreValues) {
        this.props.actions.updateCommitmentsList(barData, coreValues);
    }

    render() {
        return (
            <div className="row flex-xl-nowrap no-gutters">
                <div className="col-sm-4">
                    <CoreValuesChart handleBarClickFn={this.handleBarClick}/>
                    <CoreValuesUserFilter users={users} teams={teams} handleChangeFn={this.handleSelectChange}/>
                </div>
                <div className="col sm-8">
                    <CommitmentsList/>
                </div>
            </div>
        );
    };
}

const mapStateToProps = state => {
    return {
        isLoading: state.filterCoreValues.isLoading,
    }
}
const mapDispatchToProps = (dispatch) => ({
    actions: {
        filterCoreValues: bindActionCreators(filterCoreValues, dispatch),
        updateCommitmentsList: bindActionCreators(updateCommitmentsList, dispatch),
    },
});
export default connect(mapStateToProps, mapDispatchToProps)(Main);