import React, {PureComponent} from 'react';
import _ from 'lodash';
import {
    VictoryChart,
    VictoryTheme,
    VictoryPolarAxis,
    VictoryBar,
    VictoryTooltip
} from "victory";
import Loader from './loaders/roundLoader'

class CoreValuesChart extends PureComponent {
    constructor(props) {
        super(props);
    }
    onClick(event, data) {
        this.props.handleBarClickFn(data, this.props.coreValues);
    }
    render() {
        const {coreValues} = this.props;
        if (coreValues && coreValues.length > 0) {
            return (
                <div>
                    <VictoryChart polar theme={VictoryTheme.material}>
                        {
                            coreValues.map((d, i) => {
                                return (
                                    <VictoryPolarAxis dependentAxis
                                                      key={i}
                                                      label={d.name}
                                                      labelPlacement="perpendicular"
                                                      style={{tickLabels: {fill: "none"}}}
                                                      axisValue={i}
                                    />
                                );
                            })
                        }
                        <VictoryBar
                            style={{
                                data: {
                                    fill: (d) => d.color,
                                    width: 15,
                                    cursor: "pointer"
                                }
                            }}
                            events={[
                                {
                                    target: "data",
                                    eventHandlers: {
                                        onClick: (event, data) => this.onClick(event, data)
                                    }
                                }
                            ]}
                            cornerRadius={25}
                            data={
                                _.map(coreValues, (item, index) => {
                                    let color = '#AAA';
                                    if (this.props.currentCoreValue == null || this.props.currentCoreValue == index) {
                                        color = item.color;
                                    }
                                    return {
                                        x: index,
                                        y: item.commitments.length,
                                        label: 'x' + item.commitments.length,
                                        color: color,
                                        commitments: item.commitments,
                                    };
                                })
                            }
                            labelComponent={<VictoryTooltip/>}
                        />
                    </VictoryChart>
                </div>
            );
        } else {
            return (
                <Loader />
            );
        }
    }
}

export default CoreValuesChart;