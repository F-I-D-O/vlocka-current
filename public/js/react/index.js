import React from 'react';
import ReactDOM from 'react-dom';
import TinyMCE from 'react-tinymce';
import SerialForms from 'react-serial-forms';

"use strict";

var TextEditor = React.createClass({
	getInitialState: function() {
		return {text: ''};
	},
	handleEditorChange: function(e) {
		this.setState({text: e.target.getContent()});
		// console.log(this.state);
		// console.log(e.target.getContent());
	},
	render: function() {
		return (
			<Form url={this.props.url}>
				<TinyMCE
					config={{
						plugins: 'autolink link image lists print preview',
						toolbar: 'undo redo | bold italic | alignleft aligncenter alignright'
					}}
					onChange={this.handleEditorChange}
				/>
				<input type="submit" value="Přidej zprávu" />
			</Form>
		);
	}
});

var HidableArea = React.createClass({
	render: function() {
		return (
			<div className={this.props.open ? '' : 'hidden'}>
				{this.props.children}
			</div>
		);
	}
});

var Form = React.createClass({
	getInitialState: function() {
        return {
			serialization: ''
        };
      },
	handleSubmit: function(e) {
		e.preventDefault();
		var text = this.state.text;
		// if (!text) {
			// return;
		// }
		console.log(this.refs.form);
		$.ajax({
			url: this.props.url,
			dataType: 'json',
			type: 'POST',
			data: $(this.refs.form).serialize(),
			success: function(data) {
				// this.setState({data: data});
			}.bind(this),
			error: function(xhr, status, err) {
				console.error(this.props.url, status, err.toString());
			}.bind(this)
		});
	},
	render: function() {
		// console.log(this.props.onSubmitFunc);
		return (
			<form onSubmit={this.handleSubmit} ref="form">
				{this.props.children}
				<SerialForms.InputField name="_token" type="hidden" value={$('meta[name="application"]').data('csrf-token')} />
			</form>
		);
	}
});


var NewPostArea = React.createClass({
	getInitialState: function() {
		return {open: false};
	},
	render: function() {
		return (
			<div>
				<HidableArea  open={this.state.open} >
					<TextEditor url="./new-post" />
				</HidableArea>
				<button onClick={this.onClick}>Nová Novinka</button>
			</div>
		);
	},
	
	onClick: function() {
		this.setState({open: !this.state.open});
	}
});

function run() {
	ReactDOM.render(
		<NewPostArea/>,
		document.getElementById('new-post-area')
	);
}

const loadedStates = ['complete', 'loaded', 'interactive'];

if (loadedStates.includes(document.readyState) && document.body) {
	run();
} else {
	window.addEventListener('DOMContentLoaded', run, false);
}

