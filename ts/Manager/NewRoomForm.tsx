import React, { useState } from 'react';

type Props = {
	addRoom: (name: string) => Promise<void>;
}

const NewRoomForm: React.FC<Props> = (props) => {
	const [name, setName] = useState<string>('');
	const [processing, setProcessing] = useState<boolean>(false);
	const [error, setError] = useState<string>('');

	function addRoom(ev: React.FormEvent) {
		ev.preventDefault();

		setProcessing(true);
		setError('');

		props.addRoom(name).then(() => {
			setName('');
		}).catch(err => {
			setError(err.toString());
		}).then(() => {
			setProcessing(false);
		});
	}

	function addSingleUseRoom(ev: React.FormEvent) {
		ev.preventDefault();

		setProcessing(true);
		setError('');

		props.addSingleUseRoom(name).then(() => {
			setName('');
		}).catch(err => {
			setError(err.toString());
		}).then(() => {
			setProcessing(false);
		});
	}

	return (
		<form action="#" >
			<input
				className="newgroup-name"
				disabled={processing}
				value={name}
				placeholder={t('bbb', 'Room name')}
				onChange={(event) => { setName(event.target.value); }} />

			<button onClick={addRoom}>
				Create
			</button>
			<button onClick={addSingleUseRoom}>
				Create single use room
			</button>

			{error && <p>{error}</p>}
		</form>
		
	);
};

export default NewRoomForm;