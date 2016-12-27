var React = require('react'),
    ReactDOM = require('react-dom');

var BuyersList  = React.createClass({

    getInitialState: function(){
        return {
            data: [],
            buyers_found: 0
        }
    },
    componentDidMount: function(){
        var myResult = $.get('/production/buyers/all', function(result){
            num_of_buyers = result.length;
            this.setState({
                data: result,
                buyers_found: num_of_buyers
            })
        }.bind(this));

    },
    handleSubmit: function (e) {
        e.preventDefault();
        
        formData = {
            buyer_name: this.refs.buyer_name.value
        };
        $.ajax({
            url: "/production/buyers/add",
            type: "POST",
            data: {item: {buyer: this.refs.buyer_name.value}},
            success: function(result){

                console.log(result)

            }
        })
    },
    render: function(){
        var buyers_list = this.state.data.map(function(item, key){
            return (
                <tr key={key}>
                    <td><input name="row_sel" className="select_row" type="checkbox"/></td>
                    <td>aseef</td>
                    <td>{ item.buyer_name }</td>
                    <td>{ item.created_at }</td>
                    <td></td>
                    <td>
                        <a className="btn btn-primary"><i className="glyphicon glyphicon-eye-open"></i></a>&nbsp;
                        <a className="btn btn-warning"><i className="glyphicon glyphicon-edit"></i></a>&nbsp;
                        <a className="btn btn-danger"><i className="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
            );
        })
        return (
            <div>
                <div className="row">
                    <div className="col-sm-10 text-right">
                        &nbsp;
                    </div>
                    <div className="col-sm-2 text-center">
                        <div className="alert alert-warning"><strong>{this.state.buyers_found}</strong> buyers found</div>
                    </div>
                </div>
                <div className="w-box" id="w_sort01">
                    <div className="w-box-header">
                        <div className="pull-left">
                            <div className="btn-group">
                                <a className="btn dropdown-toggle btn-primary btn-xs" data-toggle="dropdown" href="#">
                                <i className="glyphicon glyphicon-cog"></i> Action <span className="caret"></span>
                                </a>
                                <ul className="dropdown-menu">
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <div className="pull-right">
                        Buyers List
                        </div>
                    </div>
                    <div className="w-box-content cnt_a">
                        <div className="row">
                            <div className="col-sm-12">
                                <table className="table table-responsive table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th className="table_checkbox"><input name="select_rows" className="select_rows" data-tableid="dt_gal" type="checkbox"/></th>
                                            <th>Image</th>
                                            <th>Buyer Name</th>
                                            <th>Create At</th>
                                            <th>Last Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {buyers_list}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="modal fade" id="add-buyer-modal">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <button type="button" className="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 className="modal-title">Add Buyer</h3>
                            </div>
                            <div className="modal-body">
                                <form onSubmit={this.handleSubmit}>
                                    <div className="formSep">
                                        <div className="row">
                                            <div className="col-sm-12">
                                                <label>Buyer Name </label>
                                                <input className="form-control" placeholder="Buyer Name" type="text" ref="buyer_name" id="buyer_buyer_name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div className="formSep">
                                        <div className="row">
                                            <div className="col-sm-12">
                                                <label>Image </label>
                                                <input id="buyer_image" type="file" className="file" data-preview-file-type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div className="modal-footer">
                                        <a className="btn btn-danger" data-dismiss="modal">Cancel</a>
                                        <button type="submit" name="commit" className="btn btn-success">Add Buyer </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
});

ReactDOM.render(<BuyersList />, document.getElementById('buyers_list'));