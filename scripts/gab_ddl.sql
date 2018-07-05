USE [eworkbooks]
GO

/****** Object:  Table [dbo].[gabgaw]    Script Date: 2018-07-06 9:32:35 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[gabgaw](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[unumber] [varchar](8) NOT NULL,
	[start_date] [date] NOT NULL,
	[end_date] [date] NOT NULL,
	[outer_limit] [date] NULL,
	[number_days] [int] NOT NULL,
	[grant_desc] [text] NULL,
	[granting_body] [varchar](8) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[gabgaw] ADD  CONSTRAINT [DF_gabgaw_granting_body]  DEFAULT ('ARC') FOR [granting_body]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Grants awarded' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'gabgaw'
GO

