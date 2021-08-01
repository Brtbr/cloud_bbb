import { Access, RoomLife } from './Api';

export const AccessOptions = {
	[Access.Public]: t('bbb', 'Public'),
	[Access.Password]: t('bbb', 'Internal + Password protection for guests'),
	[Access.WaitingRoom]: t('bbb', 'Internal + Waiting room for guests'),
	[Access.Internal]: t('bbb', 'Internal'),
	[Access.InternalRestricted]: t('bbb', 'Internal restricted'),
};

export const RoomLifeOptions = {
	[RoomLife.Persistent]: t('bbb', 'Permanent'),
	[RoomLife.SingleUse]: t('bbb', 'One-Time'),
};
