import React, {PureComponent} from 'react';
import _ from 'lodash';
import Select from 'react-select';

class CoreValuesUserFilter extends PureComponent {
    render() {
        const {handleChangeFn, users, teams} = this.props;

        return (
            <div>
                <Select isMulti={true} onChange={handleChangeFn} options={[
                    {
                        label: 'Utilisateurs',
                        options: _.map(users, function(item) {
                            return {value: item.id, label: item.firstname, type: "user"}
                        }),
                    },
                    {
                        label: 'Équipes',
                        options: _.map(teams, function(item) {
                            return {value: item.id, label: item.name, type: "team"}
                        }),
                    },
                ]}/>
            </div>
        );
    }
}

export default CoreValuesUserFilter;